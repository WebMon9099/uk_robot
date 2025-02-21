<?php

namespace App\Http\Controllers;
use App\Models\PressRelease;
use App\Models\PressReleaseFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use ZipArchive;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class PressReleaseController extends Controller
{
    public function index()
    {
        $pressReleases = PressRelease::with('files')->get();
        $nopressReleases = $pressReleases->isEmpty();
        return view('admin.pressRelease.pressRelesae', compact('pressReleases', 'nopressReleases'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:press_releases,title',
            'files.*' => 'mimes:jpg,jpeg,png,pdf',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $pressRelease = PressRelease::create($request->only('title', 'content'));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('press_releases', 'public');
                $fileType = $file->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image';

                PressReleaseFile::create([
                    'press_release_id' => $pressRelease->id,
                    'file_path' => $path,
                    'file_type' => $fileType,
                ]);
            }
        } else {

            return response()->json([
                'success' => false,
                'errors' => ['files' => ['At least one ganesh file is required.']],
            ], 422);
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('press.release'),
        ]);

    }

    public function update(Request $request, $id)
    {
        $pressRelease = PressRelease::findOrFail($id);

        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'mimes:jpeg,jpg,png,gif,pdf|max:10240', // Modify as per your needs
        ]);

        // Handle image deletion
        $imagesToDelete = $request->input('delete_images', []);
        foreach ($imagesToDelete as $imagePath) {
            $pressReleaseFile = PressReleaseFile::where('press_release_id', $pressRelease->id)
                ->where('file_path', $imagePath)
                ->first();

            if ($pressReleaseFile && Storage::exists($imagePath)) {
                // Delete the file from storage
                Storage::delete($imagePath);

                // Delete from the database
                $pressReleaseFile->delete();
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $uploadedImages[] = $image->store('press_images', 'public');
            }

            // Merge old and new images
            foreach ($uploadedImages as $imagePath) {
                // Determine file type
                $fileType = pathinfo($imagePath, PATHINFO_EXTENSION) === 'pdf' ? 'pdf' : 'image';

                // Store new image in PressReleaseFile table
                PressReleaseFile::create([
                    'press_release_id' => $pressRelease->id,
                    'file_path' => $imagePath,
                    'file_type' => $fileType,
                ]);
            }
        }

        // Update the press release title and content
        $pressRelease->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('press.release')->with('success', 'PressPack updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'press_id' => 'required|exists:press_releases,id',
            'image_path' => 'required|string'
        ]);

        $pressRelease = PressRelease::findOrFail($request->press_id);

        // Check if the image exists in the press release's files
        $imagePath = $request->image_path;

        // Assuming the images are stored in 'public/press_releases/'
        if (Storage::exists('public/' . $imagePath)) {
            Storage::delete('public/' . $imagePath);

            // Remove the file from the `files` relationship in the database
            $pressRelease->files()->where('file_path', $imagePath)->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id');
        $pressRelease = PressRelease::findOrFail($id);

        // Delete associated files from storage
        foreach ($pressRelease->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        // Delete the press release from the database
        $pressRelease->delete();

        return redirect()->route('press.release')->with('success', 'Press Release deleted successfully.');
    }
    public function showPressRelesase()
    {
        // Eager load the 'files' relationship
        $pressReleases = PressRelease::with('files')->get();
        return view('pressRelease.index', compact('pressReleases'));
    }


    public function downloadMediaKit()
    {
        // Define the zip file name
        $zipFileName = 'media_kit.zip';

        // Create a temporary file to hold the zip
        $zipFilePath = storage_path($zipFileName);
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            // Fetch all press releases with their associated files
            $pressReleases = PressRelease::with('files')->get();

            foreach ($pressReleases as $pressRelease) {
                // Use the folder name based on the press release title
                $folderName = 'press_releases/' . Str::slug($pressRelease->title);

                foreach ($pressRelease->files as $file) {
                    // Get the full file path
                    $filePath = storage_path('app/public/' . $file->file_path);

                    // Check if the file exists before adding to zip
                    if (file_exists($filePath)) {
                        // Add the file to the zip, preserving folder structure
                        $zip->addFile($filePath, basename($filePath));

                    }
                }
            }

            // Close the zip
            $zip->close();

            // Return the zip file as a download response
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Unable to create zip file.');
        }
    }

    public function downloadImages()
    {
        $zipFileName = 'images_media_kit.zip';
        $zipFilePath = storage_path($zipFileName);
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $pressReleases = PressRelease::with('files')->get();

            foreach ($pressReleases as $pressRelease) {
                $folderName = 'images/' . Str::slug($pressRelease->title);

                foreach ($pressRelease->files as $file) {
                    if ($file->file_type === 'image') {
                        $filePath = storage_path('app/public/' . $file->file_path);
                        if (file_exists($filePath)) {
                            $zip->addFile($filePath, $folderName . '/' . basename($filePath));
                        }
                    }
                }
            }

            $zip->close();
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Unable to create zip file for images.');
        }
    }
    public function downloadPdfs()
    {
        $zipFileName = 'pdfs_media_kit.zip';
        $zipFilePath = storage_path($zipFileName);
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $pressReleases = PressRelease::with('files')->get();

            foreach ($pressReleases as $pressRelease) {
                $folderName = 'pdf/' . Str::slug($pressRelease->title);

                foreach ($pressRelease->files as $file) {
                    if ($file->file_type === 'pdf') {
                        $filePath = storage_path('app/public/' . $file->file_path);
                        if (file_exists($filePath)) {
                            $zip->addFile($filePath, $folderName . '/' . basename($filePath));
                        }
                    }
                }
            }

            $zip->close();
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Unable to create zip file for PDFs.');
        }
    }

    
    public function showFilesPage()
    {
        $files = PressReleaseFile::all(); // Adjust as needed to retrieve files based on your application logic
        return view('admin.pressRelease.files', compact('files'));
    }

    // Handle File Deletion
    public function deleteFile(Request $request)
    {
        $request->validate([
            'file_id' => 'required|exists:press_release_files,id',
        ]);
    
        $file = PressReleaseFile::findOrFail($request->file_id);
    
        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }
    
        $file->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully!',
        ]);
    }


}
