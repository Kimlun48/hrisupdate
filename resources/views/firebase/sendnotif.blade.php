<form action="/send-push-notification" method="POST">
    @csrf
    <div>
        <label for="to">To:</label>
        <input type="text" name="to" id="to" required>
    </div>
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="body">Body:</label>
        <textarea name="body" id="body" required></textarea>
    </div>
    <div>
        <label for="icon">Icon:</label>
        <input type="text" name="icon" id="icon">
    </div>
    <div>
        <label for="url">URL:</label>
        <input type="text" name="url" id="url">
    </div>
    <div>
        <button type="submit">Send wkwk Notification</button>
    </div>
</form>

