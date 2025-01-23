namespace App\Controllers;

use App\Models\AktivitasModel;

class AktivitasController extends BaseController
{
    public function index()
    {
        $model = new AktivitasModel();
        $data['aktivitas'] = $model->findAll();

        echo view('header');
        echo view('menu');
        echo view('aktivitas_view', $data);
        echo view('footer');
    }

    public function catatAktivitas($user_id, $nama_user, $action, $details = null)
    {
        $model = new AktivitasModel();
        $model->insert([
            'user_id' => $user_id,
            'nama_user' => $nama_user,
            'action' => $action,
            'action_time' => date('Y-m-d H:i:s'),
            'details' => $details
        ]);
    }
}
