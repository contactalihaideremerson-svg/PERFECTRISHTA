<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-4xl mx-auto px-4 py-10 h-[80vh] flex flex-col">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
        <!-- Chat Header -->
        <div class="p-4 border-b border-gray-100 flex items-center bg-gray-50/50">
            <a href="<?php echo URLROOT; ?>/messages" class="mr-4 text-gray-400 hover:text-pink-600 transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['other_profile']->profile_pic; ?>"
                class="w-10 h-10 rounded-full object-cover mr-3">
            <div>
                <h3 class="font-bold text-gray-900">
                    <?php echo $data['other_user']->name; ?>
                </h3>
                <span class="text-xs text-green-500 flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5 animate-pulse"></span> Online
                </span>
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4" id="chat-window">
            <?php if (empty($data['messages'])): ?>
                <div class="text-center py-20">
                    <p class="text-gray-400 text-sm">This is the start of your journey together.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['messages'] as $msg): ?>
                    <?php $is_mine = ($msg->sender_id == $_SESSION['user_id']); ?>
                    <div class="flex <?php echo $is_mine ? 'justify-end' : 'justify-start'; ?>">
                        <div
                            class="max-w-[70%] <?php echo $is_mine ? 'bg-pink-600 text-white rounded-l-2xl rounded-tr-2xl' : 'bg-gray-100 text-gray-800 rounded-r-2xl rounded-tl-2xl'; ?> p-4 text-sm shadow-sm">
                            <?php echo $msg->message; ?>
                            <p class="text-[10px] mt-1 opacity-70 <?php echo $is_mine ? 'text-right' : 'text-left'; ?>">
                                <?php echo date('H:i', strtotime($msg->created_at)); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Message Input -->
        <div class="p-4 border-t border-gray-100 bg-white">
            <form action="<?php echo URLROOT; ?>/messages/chat/<?php echo $data['other_user']->id; ?>" method="POST"
                class="flex gap-2">
                <div class="flex-1 relative">
                    <input type="text" name="message" placeholder="Type your message..." autofocus
                        class="w-full bg-gray-100 border-transparent rounded-full px-5 py-3 focus:bg-white focus:ring-2 focus:ring-pink-500 focus:border-transparent transition text-sm outline-none">
                    <button type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-pink-600 transition">
                        <i class="fas fa-paperclip"></i>
                    </button>
                </div>
                <button type="submit"
                    class="bg-pink-600 text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-pink-700 transition shadow-lg shadow-pink-100">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const chatWindow = document.getElementById('chat-window');
    chatWindow.scrollTop = chatWindow.scrollHeight;
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>

