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

    public function postAttachment(int $token_id)
    {

        if (!request()->file('attachments'))
            return redirect()->back()->with('error', 'Nenhum arquivo selecionado!');

        foreach (request()->file('attachments') as $file) {
            $attachment = new Attachment();
            $attachment->tickets_id = $token_id;
            $attachment->path = $file->storeAs('attachments', $file->getClientOriginalName());
            $attachment->save();
        };

        return redirect()->back()->with('success', 'Anexo(s) adicionado(s) com sucesso!');
    }
}
