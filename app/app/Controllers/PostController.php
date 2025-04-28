<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PostController extends BaseController
{
    public function index()
    {
        $model = new PostModel();
        $posts = $model->findAll();
        return view('posts/index', ['posts' => $posts]);
        
    }

    public function create(){
        return view('posts/create');
    }

    public function store()
    {
        // var_dump($this->request->getPost());
        $model = new PostModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'body' => $this->request->getPost('body')
        ]);
        return redirect()->to('/posts')->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $model = new PostModel();
        $data['post'] = $model->find($id);
        return view('posts/edit', $data);
    }

    public function update($id)
    {
        $model = new PostModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'body' => $this->request->getPost('body')
        ]);
        return redirect()->to('/posts')->with('success', 'Post updated successfully');
    }

    public function delete($id)
    {
        $model = new PostModel();
        $model->delete($id);
        return redirect()->to('/posts')->with('success', 'Post deleted successfully');

    }


}
