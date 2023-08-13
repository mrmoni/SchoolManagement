<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Student
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Najibul Middya
 * @param     ...
 * @return    ...
 *
 */

class Student_admission extends CI_Controller
{
  private $ud = [];
  public function __construct()
  {
    parent::__construct();
    $this->load->model('student_model');
    $this->load->model(['student_class_model', 'student_class_model', 'admission_model']);
    $this->ud = has_loggedIn();
  }

  private function view($id = null)
  {
    if ($data = $this->admission_model->get($id)) {
      view('admission/edit', compact("data"), "Portal | Admission Create");
    } else {
      $students = $this->student_model->get_all();
      $classes = $this->student_class_model->get_all();
      view('admission/create', compact("students", "classes"), "Portal | Admission Create");
    }
  }

  public function index()
  {
    $students = $this->admission_model->get_all();
    view('admission/index', compact("students"), "Portal | Admission Create");
  }

  public function save($id = null)
  {
    try {

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // $this->form_validation->set_rules("student_id", "Name", "trim|required");
        // $this->form_validation->set_rules("current_class_id", "Current Classes", "trim|required");
        // $this->form_validation->set_rules("remarks", "Remarks", "trim|required");
        $student_id = $this->input->post('student_id');
        $current_class_id = $this->input->post('current_class_id');
        $remarks = $this->input->post('remarks');


        // if ($this->form_validation->run() == true) {

        if ($student = $this->student_model->get($student_id)) {

          $name = $student->name;
          $prev_class_id = $student->class_id;
          $data = [
            "name" => $name,
            "student_id" => $student_id,
            "prev_class_id" => $prev_class_id,
            "current_class_id" => $current_class_id,
            "remarks" => $remarks,
          ];
        }

        if ($id) {
          if ($resp = $this->admission_model->update($id, $data)) {
            echo jresp(true, "Update successfully", $resp);
          } else {
            echo jresp(false, "Update failed");
          }
        } else {
          if ($resp = $this->admission_model->insert($data)) {
            echo jresp(true, "Admission successfully", $resp);
          } else {
            echo jresp(false, "Admission failed");
          }
        }

        redirect(base_url("student_admission"));
        // } else {
        //   $this->view($id);
        // }
      } else {
        $this->view($id);
      }
    } catch (\Throwable $th) {
      redirect(base_url("student_admission"));
    }
  }


  public function delete($id = null)
  {
    try {
      if ($this->admission_model->get($id)) {
        if ($this->admission_model->delete($id)) {
          alert("success", "Student deleted successfully");
        } else {
          alert("danger", "Student delete failed");
        }
        redirect(base_url("student_admission"));
      } else {
        alert("danger", "Student not available");
      }
    } catch (\Throwable $th) {
      redirect(base_url("student_admission"));
    }
  }
}


/* End of file Student.php */
/* Location: ./application/controllers/Student.php */