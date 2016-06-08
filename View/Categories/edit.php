<?php require 'View/Layouts/checkLogined.php'; ?> 
<?php require 'View/Layouts/menu_admin.php'; ?>
    </ul>
</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?controller=Categories&action=index">List Categories</a> <span class="divider"></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form class="form-horizontal" action="?controller=Categories&action=edit&id=<?php echo $_GET['id']; ?>" method="POST">
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9">
                            	<input type="text"  placeholder="some text value..." 
                            			value="<?php echo $result['Clist']['category_name'];?> " 
                						name="edit-category-name" required>
                            </div>
                            <div class="clear"></div>
                            <span id="message"><?php if (isset($result['message'])) {
                                    echo $result['message'] ;
                                } ?></span>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="select" name="edit-activate" >
                                        <option value="0">choose a option...</option>
                                        <option value="1" <?php if($result['Clist']['activate'] == 1) echo ' selected="selected"'; ?> >Activate</option>
                                        <option value="2" <?php if($result['Clist']['activate'] == 2) echo ' selected="selected"'; ?> >Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="Update">Update</button>
							<div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div> 
</div> 