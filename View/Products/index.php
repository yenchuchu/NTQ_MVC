<?php require 'View/Layouts/checkLogined.php'; ?>
<?php require 'View/Layouts/menu_admin.php'; ?>
    </ul>
</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Products&action=index">List Products</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form class="form-horizontal" action="?controller=Products&action=index" 
                        method="POST" id="search-products" >
                    <input type="text" class="span11" name="search-name"
                            placeholder="Enter name product..." value="<?php if (isset($_POST['search-name'])) {
                                echo $_POST['search-name']; } ?>" />
                    <button class="btn span1" type="submit" name="btn-search">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="?controller=Products&action=add" class="btn btn-add">Add Product</a>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="10%" class="sorting"><a href="#">ID</a></th>
                            <th width="15%" class="sorting"><a href="#">Product Name</a></th>
                            <th width="15%" class="sorting"><a href="#">Category Name</a></th>
                            <th width="15%" class="sorting"><a href="#">Price</a></th>
                            <th width="15%" class="sorting"><a href="#">Activate</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result['Plists'] as $product) { $id_category = $product['category_id']; ?>
                                <tr>
                                    <td><input type="checkbox" name="product_id[]"
                                                value="<?php echo $product['id']; ?>" 
                                                id = "<?php echo $product['id']; ?>"/></td>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    <td><?php echo $result['category'][$id_category][$id_category]; ?></td>
                                    <td><?php echo $product['price']; ?> VND</td>
                                    <td><?php 
                                        if ($product['activate'] == 1) { ?>
                                            <span class="text-success"> 
                                            <?php    echo "Activated"; ?> </span>
                                        <?php } else {
                                        ?> <span class="text-error"> <?php    echo "Deactivate";
                                        }  ?></span></td>
                                    <td><?php 
                                        $date=date_create($product['created']);
                                        echo date_format( $date,"H:i d/m/Y"); ?></td>
                                    <td><?php 
                                        $date=date_create($product['modified']);
                                        echo date_format( $date,"H:i d/m/Y") ;  ?></td>
                                    <td><a href="?controller=Products&action=edit&id=<?php echo $product['id']; ?>" class="btn btn-info">Edit</a></td>
                                </tr> 
                            <?php } ?> 
                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <a href="#" class="btn btn-success">Activate</a>
                        <a href="#" class="btn btn-danger" id="delete">Delete</a>
                    </div><!-- /bulk-action-->
                    <div class="dataTables_paginate">
                        <a class="first paginate_button <?php if ($result['current_page'] == 1) {
                                            echo "paginate_button_disabled"; } ?>" 
                           href="?controller=Products&action=index&page=<?php echo '1'; ?>"> First
                        </a>
                        <a class="previous paginate_button <?php if ($result['current_page'] == 1) {
                                            echo "paginate_button_disabled"; } ?>" 
                           href="?controller=Products&action=index&page=<?php if($result['current_page']-1 < 1) { echo '1'; }
                                                  else { echo $result['current_page']-1; } ?>"> Previous
                        </a>
                        <span>
                        <?php  
                            for ( $page = 1; $page <= $result['pages']; $page ++ ) {
                            echo "<a class='paginate_active' href='?controller=Products&action=index&page=".$page."'>".$page."</a>";
                            }
                         ?> 
                        </span>
                        <a class="next paginate_button <?php if ($result['current_page'] == $result['pages']) {
                                            echo "paginate_button_disabled"; } ?>" 
                            href="?controller=Products&action=index&page=<?php echo $result['current_page']+1; ?>"> Next
                        </a>
                        <a class="last paginate_button <?php if ($result['current_page'] == $result['pages']) {
                                            echo "paginate_button_disabled"; } ?>" 
                           href="?controller=Products&action=index&page=<?php echo $result['pages']; ?>">Last</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

<script type="text/javascript" > 

        $('#delete').click(function () {
            ids = new Array();
            $("input:checkbox[name='product_id[]']:checked").each(function () {
                ids.push($(this).val());
            });

            if (ids.length >= 1) {
                deleteAll("?controller=Products&action=delete", ids); 
            } else {
                return false;
            }
        });
    

</script>