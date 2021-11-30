<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\{Http\RedirectResponse, Support\Facades\Storage};

/**
 * Classe para manipulação de anexos de tickets
 */
class AttachmentController extends Controller
{

    /**
     * Método responsável por salvar um anexo e cadastrar no banco de dados.
     * @param int $token_id
     * @return RedirectResponse
     */
    public function postAttachment(int $token_id)
    {

        // Verifica se o arquivo foi enviado.
        if (!request()->file('attachments'))
            return redirect()->back()->with('error', 'Nenhum arquivo selecionado!');

        // Percorre o array de arquivos enviados.
        foreach (request()->file('attachments') as $file) {
            // Cria um novo anexo.
            $attachment = new Attachment();
            $attachment->tickets_id = $token_id;

            // Salva o anexo no disco.
            $attachment->path = $file->storeAs('attachments', $file->getClientOriginalName());
            // Salva o anexo no banco de dados.
            $attachment->save();
        };

        // Redireciona para a página anterior com mensagem de sucesso.
        return redirect()->back()->with('success', 'Anexo(s) adicionado(s) com sucesso!');
    }

    /**
     *  Método responsável por deletar um anexo.
     * @return RedirectResponse
     */
    public function deleteAttachment()
    {
        // Recupera o anexo.
        $id = request('id');
        $attachment = Attachment::find($id);

        // Deleta o anexo.
        Storage::delete($attachment->path);
        $attachment::destroy($id);

        // Redireciona para a página anterior com a mensagem de sucesso.
        return redirect()->back()->with('success', 'Anexo deletado com sucesso!');
    }
}
