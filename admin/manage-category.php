<html>
    <head>
        <title>Manage Category </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

        <?php include('partials/menu.php'); ?>
         <!-- main contain section start -->
         <div class="main-content">
        <div class="wrapper">
               <h1>MANAGE CATEGORY</h1>
               <br/><br/>
               <a href="#" class="btn-primary">Add Category</a>
               <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>Sl.No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td>xyz</td>
                        <td>xyz name</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2.</td>
                        <td>xyz</td>
                        <td>xyz name</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3.</td>
                        <td>xyz</td>
                        <td>xyz name</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- main contain section end -->
        <?php include('partials/footer.php');?>