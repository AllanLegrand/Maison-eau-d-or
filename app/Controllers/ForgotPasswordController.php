<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UtilisateursModel;
class ForgotPasswordController extends Controller
{
	public function index()
	{
		helper(['form']);
		return view('forgot_password');
	}

	public function sendResetLink()
	{
		$email = $this->request->getPost('email');
		$userModel = new UtilisateursModel();
		$user = $userModel->where('email', $email)->first();

		if ($user) {
			$token = bin2hex(random_bytes(16));
			$expiration = date('Y-m-d H:i:s', strtotime('+2 hour'));
			$userModel->set('rst_tkn', $token)
				->set('rst_tkn_exp', $expiration)
				->update($user['id_util']);
			
			$resetLink = site_url("reset-password/$token");
			$message = "Cliquez sur le lien suivant pour réinitialiser MDP: $resetLink";
			$emailService = \Config\Services::email();

			$from = 'mailingtestIUT@gmail.com';

			$to = $this->request->getPost('to');
			$subject = $this->request->getPost('subject');

			$emailService->setTo($email);
			$emailService->setFrom($from);
			$emailService->setSubject('Réinitialisation de mot de passe');
			$emailService->setMessage($message);
			if ($emailService->send()) {
				echo view('mail_succes' );
			} else {
				echo $emailService->printDebugger();
			}
		} else {
			echo 'Adresse e-mail non valide.';
		}
	}
}