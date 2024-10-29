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

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>Mã đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Hình thức</th>
                <th>Trạng thái</th>
                <th>Xem chi tiết</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input type="checkbox"></th>
                <td>DHMS5</td>
                <td>Hoàng Minh</td>
                <td>14-06-2017</td>
                <td>Chuyển khoản</td>
                <td>Đã duyệt</td>
                <td><a href="#">Xem chi tiết</a></td>
                <td>
                    <div class="action-buttons" style="justify-content: center; color: red;">
                        <a href="#"><i class="fa-solid fa-check"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>