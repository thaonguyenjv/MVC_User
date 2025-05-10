<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .search-container {
            margin-bottom: 20px;
            display: flex;
        }

        #search-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        #search-button {
            padding: 10px 15px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 16px;
        }

        #search-button:hover {
            background-color: #166fe5;
        }

        .user-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .user-list {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        table th {
            background-color: #f8f8f8;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .user-url {
            color: #1877f2;
            text-decoration: none;
        }

        .user-url:hover {
            text-decoration: underline;
        }

        .user-details {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: none;
        }

        .user-details.active {
            display: block;
        }

        .user-details h3 {
            margin-top: 0;
            color: #1877f2;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <main>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('search-input');
            const searchButton = document.getElementById('search-button');
            const userList = document.getElementById('user-list');
            
            // Xử lý sự kiện tìm kiếm
            searchButton.addEventListener('click', function() {
                searchUsers();
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchUsers();
                }
            });
            
            // Hàm tìm kiếm sử dụng AJAX
            function searchUsers() {
                const keyword = searchInput.value.trim();
                if (keyword.length === 0) {
                    return;
                }
                
                fetch(`index.php?action=search&keyword=${encodeURIComponent(keyword)}`) //ajax call to search users
                    .then(response => response.json())
                    .then(data => {
                        // Cập nhật bảng với kết quả tìm kiếm
                        const tbody = userList.querySelector('tbody');
                        tbody.innerHTML = '';
                        
                        if (data.length > 0) {
                            data.forEach(user => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${user.id}</td>
                                    <td>${user.username}</td>
                                    <td><a href="#" class="user-url" data-id="${user.id}">${user.url}</a></td>
                                `;
                                tbody.appendChild(row);
                            });
                            
                            // Gắn lại event listeners cho các phần tử mới
                            attachUserUrlEventListeners();
                        } else {
                            const row = document.createElement('tr');
                            row.innerHTML = '<td colspan="3">Không tìm thấy user nào</td>';
                            tbody.appendChild(row);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
            
            // Xử lý sự kiện click vào URL người dùng
            function attachUserUrlEventListeners() {
                const userUrls = document.querySelectorAll('.user-url');
                const userDetails = document.getElementById('user-details');
                
                userUrls.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault(); // Ngăn hành vi mặc định của liên kết
                        const userId = this.getAttribute('data-id');
                        
                         // AJAX call để lấy chi tiết người dùng
                        fetch(`index.php?action=detail&id=${userId}`)
                            .then(response => response.json())
                            .then(data => {
                                userDetails.innerHTML = `
                                    <h3>Thông tin Chi Tiết </h3>
                                    <p><strong>ID:</strong> ${data.id}</p>
                                    <p><strong>Username:</strong> ${data.username}</p>
                                    <p><strong>URL:</strong> <a href="${data.url}" target="_blank">${data.url}</a></p>
                                `;
                                userDetails.classList.add('active');
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            }
            
             // Khởi tạo event 
            attachUserUrlEventListeners();
        });
    </script>
</body>
</html>