<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">Your Messages</h2>
            <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-xs font-bold uppercase">All Chats</span>
        </div>

        <div class="divide-y divide-gray-50">
            <?php if (empty($data['chats'])): ?>
                <div class="p-12 text-center">
                    <div
                        class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <i class="fas fa-comment-slash text-2xl"></i>
                    </div>
                    <p class="text-gray-500">No active conversations yet.</p>
                    <a href="<?php echo URLROOT; ?>/profiles"
                        class="mt-4 inline-block text-pink-600 font-bold hover:underline">Find matches to start chatting</a>
                </div>
            <?php else: ?>
                <?php foreach ($data['chats'] as $chat): ?>
                    <a href="<?php echo URLROOT; ?>/messages/chat/<?php echo $chat->id; ?>"
                        class="flex items-center p-6 hover:bg-gray-50 transition group">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $chat->profile_pic; ?>"
                            class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-sm mr-4">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 group-hover:text-pink-600 transition">
                                <?php echo $chat->name; ?>
                            </h3>
                            <p class="text-sm text-gray-500 truncate max-w-xs">
                                <?php echo $chat->last_message ?: 'Start a conversation...'; ?>
                            </p>
                        </div>
                        <div class="text-xs text-gray-400">
                            <i class="fas fa-chevron-right text-lg"></i>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

