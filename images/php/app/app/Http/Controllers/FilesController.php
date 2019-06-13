<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as StoredFile;
use App\Models\File;
use App\Models\Meta;

class FilesController extends Controller
{
    /**
     * List all stored files.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        try {
            $files = File::all();

            return response()->json($files);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get a file.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOne($fileId)
    {
        try {
            $file = File::find($fileId);
            //base64 should be ok
            $file->base64_content = base64_encode(file_get_contents($file->path));

            return response()->json($file);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get the storage space used.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStorageSpaceUsed()
    {
        try {
            $spaceUsed = 0;

            $destinationPath = base_path() . '/public/uploads';
            $files = StoredFile::allFiles($destinationPath);

            foreach ($files as $file) {
                $spaceUsed += $file->getSize();
            }

            return response()->json([
                'spaceUsed' => $spaceUsed
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a file.
     *
     * @return \Illuminate\Http\Response
     */
    public function postFile(Request $request)
    {
        try {
            //Start transaction!
            \DB::beginTransaction();

            if ($request->hasFile('file')) {
                //save the file to disk
                $uploadedFile = $request->file('file');
                $originalFileName = $uploadedFile->getClientOriginalName();
                $originalFileSize = $uploadedFile->getSize();
                $fileName = uniqid() . '_' . $originalFileName;
                $path = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR;
                $destinationPath = base_path() . '/public/uploads';
                Storage::disk('local')->makeDirectory($destinationPath, 0777, true, true);
                $uploadedFile->move($destinationPath, $fileName);

                $file = File::create([
                    'name' => $originalFileName,
                    'size' => $originalFileSize,
                    'path' => $destinationPath . DIRECTORY_SEPARATOR . $fileName
                ]);

                $info = pathinfo($destinationPath . DIRECTORY_SEPARATOR . $fileName);
                $ext = $info['extension'];

                Meta::create([
                    'file_id' => $file->id,
                    'name'    => 'extension',
                    'value'   => $ext
                ]);

                Meta::create([
                    'file_id' => $file->id,
                    'name'    => 'size',
                    'value'   => $originalFileSize
                ]);

                //Commit the queries!
                \DB::commit();

                return response()->json($file);
            } else {
                $response = new \StdClass();
                $response->errors = ['No file was provided'];

                return response()->json(
                    $response,
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        } catch (\Exception $e) {
            //Rollback the queries!
            \DB::rollback();
            abort(404);
        }
    }

    /**
     * Delete a stored file.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFile($fileId)
    {
        try {
            \DB::beginTransaction();

            Meta::where(['file_id' => $fileId])->delete();
            $file = File::where(['id' => $fileId])->firstOrFail();
            Storage::disk('local')->delete($file->path);
            $file->delete();

            //Commit the queries!
            \DB::commit();

            return response()->json($file);
        } catch (\Exception $e) {
            //Rollback the queries!
            \DB::rollback();

            $response = new \StdClass();
            $response->errors = ['No file was found.'];

            return response()->json(
                $response,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
