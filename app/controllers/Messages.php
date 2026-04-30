<?php
class Messages extends Controller
{
    private $messageModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->messageModel = $this->model('Message');
    }

    public function index()
    {
        $chats = $this->messageModel->getRecentChats($_SESSION['user_id']);

        $data = [
            'chats' => $chats
        ];

        $this->view('messages/index', $data);
    }

    public function chat($other_id = null)
    {
        if ($other_id === null) {
            redirect('messages');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $data = [
                'sender_id' => $_SESSION['user_id'],
                'receiver_id' => $other_id,
                'message' => trim($_POST['message']),
                'type' => 'text'
            ];

            if (!empty($data['message'])) {
                $this->messageModel->addMessage($data);
                redirect('messages/chat/' . $other_id);
            }
        }

        $messages = $this->messageModel->getMessages($_SESSION['user_id'], $other_id);
        $other_user = $this->model('User')->getUserById($other_id);
        $other_profile = $this->model('Profile')->getProfileByUserId($other_id);

        if (!$other_user) {
            redirect('messages');
        }

        $data = [
            'messages' => $messages,
            'other_user' => $other_user,
            'other_profile' => $other_profile
        ];

        $this->view('messages/chat', $data);
    }
}

