<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\EnrollmentModel;

class Materials extends BaseController
{
    public function upload($course_id)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || !in_array($session->get('role'), ['admin', 'teacher'])) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'material_file' => [
                    'label' => 'Material File',
                    'rules' => 'uploaded[material_file]|max_size[material_file,10240]|ext_in[material_file,pdf,doc,docx,ppt,pptx,txt,jpg,jpeg,png]',
                ],
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                $session->setFlashdata('error', $validation->getError('material_file'));
                return redirect()->to('/admin/course/' . $course_id . '/upload');
            }

            $file = $this->request->getFile('material_file');

            if ($file->isValid() && !$file->hasMoved()) {
                $uploadPath = WRITEPATH . 'uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $materialModel = new MaterialModel();
                $data = [
                    'course_id' => $course_id,
                    'file_name' => $file->getClientName(),
                    'file_path' => $newName,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                if ($materialModel->insertMaterial($data)) {
                    $session->setFlashdata('success', 'Material uploaded successfully.');
                } else {
                    $session->setFlashdata('error', 'Failed to save material.');
                }
            } else {
                $session->setFlashdata('error', 'Invalid file.');
            }

            return redirect()->to('/admin/course/' . $course_id . '/upload');
        }

        return view('materials/upload', ['course_id' => $course_id]);
    }

    public function delete($material_id)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || !in_array($session->get('role'), ['admin', 'teacher'])) {
            return redirect()->to('/dashboard');
        }

        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = WRITEPATH . 'uploads/' . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $materialModel->delete($material_id);
            $session->setFlashdata('success', 'Material deleted.');
        }

        return redirect()->back();
    }

    public function download($material_id)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $enrollmentModel = new EnrollmentModel();
        $user_id = $session->get('userID');
        if (!$enrollmentModel->isAlreadyEnrolled($user_id, $material['course_id'])) {
            return $this->response->setStatusCode(403)->setBody('Access denied.');
        }

        $filePath = WRITEPATH . 'uploads/' . $material['file_path'];
        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->download($filePath, null, true)->setFileName($material['file_name']);
    }
}
