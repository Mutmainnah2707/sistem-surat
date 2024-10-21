<?php

namespace App\Controllers;

use App\Models\DispositionModel;
use App\Models\LetterModel;
use App\Models\LetterRecipientModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session, $groupModel, $userModel, $letterModel, $letterRecipientModel, $dispositionModel, $data;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        /* MY CUSTOM */
        $this->session = \Config\Services::session();

        // Mengakses Model
        $this->groupModel = new GroupModel();
        $this->userModel = new UserModel();
        $this->letterModel = new LetterModel();
        $this->letterRecipientModel = new LetterRecipientModel();
        $this->dispositionModel = new DispositionModel();

        // Get data surat masuk yg belum dibaca oleh penerima surat berdasarkan id pengguna yang sedang login
        $this->data['incomingLetterNotifications'] = $this->letterRecipientModel
            ->select('*, senders.name as sender, letter_recipients.received_date')
            ->join('letters', 'letters.id = letter_recipients.letter_id')
            ->join('users as senders', 'senders.id = letters.user_id')
            ->where('letter_recipients.user_id', user()->id)->where('is_read', 0)
            ->get()->getResultArray();

        // Get jumlah surat masuk yang belum dibaca
        $this->data['countIsRead'] = count($this->data['incomingLetterNotifications']);
    }
}
