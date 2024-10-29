<link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .btn-add {
            background-color: #008CBA; /* Blue */
            color: white;
            margin-bottom: 10px;
            position: right;
        }
    </style>
</head>
<body>

<input type="text" placeholder="Tìm kiếm">
<button>Tìm</button>
<button class="btn btn-add">Thêm mới</button>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Quyền hạn</th>
                <th>Hiển thị</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input type="checkbox"></th>
                <td>1</td>
                <td>Administrator</td>
                <td>Administrator</td>
                <td>Hiện</td>
                <td>
                    <div class="action-buttons" style="justify-content: center; color: red;">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <i class="fa-regular fa-circle-xmark"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>