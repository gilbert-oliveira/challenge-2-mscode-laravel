<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function deleteAttachment()
    {
        $id = request('id');
        $attachment = Attachment::find($id);
        Storage::delete($attachment->path);
        $attachment::destroy($id);

        return redirect()->back()->with('success', 'Anexo deletado com sucesso!');
    }
}
