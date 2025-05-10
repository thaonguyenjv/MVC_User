<div class="search-container">
    <input type="text" id="search-input" placeholder="Tìm kiếm...">
    <button id="search-button">Search</button>
</div>

<div class="user-container">
    <h2>User List</h2>
    <div class="user-list" id="user-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><a href="#" class="user-url" data-id="<?php echo $user['id']; ?>"><?php echo $user['url']; ?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div id="user-details" class="user-details">
        <!-- chi tiết người dùng hiện ở đây với ajax -->
    </div>
</div>