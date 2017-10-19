<?php ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content">
        <section>
            <div class="white-wrapper">
                <div class="col-md-12">
                    <div class="hr-title">
                        <h2>Add Chemist</h2>
                        <hr>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chemist Name"> 
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chemist Person"> 
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chemist Mobile No"> 
                        </div>
                        <div class="col-sm-6 ">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chemist Landline"> 
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="5" placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <select name="Country" class="error form-control" id="Country" aria-invalid="true">
                                <option value="0">State</option>

                            </select>  
                        </div>
                        <div class="col-sm-6">
                            <select name="Country" class="error form-control" id="Country" aria-invalid="true">
                                <option value="0">City</option>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group mar-bottom-40">
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Pincode">
                        </div>

                    </div>

                    <div class="form-group pull-right">
                        <div class="col-sm-12">
                            <a href="#add_price" class="common-btn blue-btn btn-125 popup-modal" >Submit</a>
                        </div>
                    </div>

                    <div class="mfp-hide white-popup-block small_popup" id="add_price">
                        <div class="popup-content">
                            <div class="popup-header">
                                <button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
                                <div class="hr-title"><h4>Add Price</h4><hr /></div>
                            </div>
                            <div class="popup-body">
                                <form>
                                    <div class="row">
                                        <div class="add-price-info clearfix">
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-6 col-xs-6 add-price-info-rgt">
                                                            <input type="number" class="form-control" id="inputSkills" placeholder="Size">
                                                        </div>
                                                        <div class="col-sm-6 col-xs-6 add-price-info-lft">
                                                            <select name="Country" class="error form-control" id="Country" aria-invalid="true"><option value="0">oz</option></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-6 col-xs-6 add-price-info-rgt">
                                                            <input type="text" class="form-control" id="inputSkills" placeholder="Price">
                                                        </div>
                                                        <div class="col-sm-6 col-xs-6 add-price-info-lft">
                                                            <select name="Country" class="error form-control" id="Country" aria-invalid="true"><option value="0">$</option></select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div> 
                                        </div> 
                                        <div class="add-price-info clearfix">
                                            <div class="col-sm-3 col-xs-3 add-price-info-rgt">
                                                <input type="text" class="form-control" id="inputName" placeholder="0">
                                            </div>
                                            <div class="col-sm-3 col-xs-3 add-price-info-lft">
                                                <select name="Country" class="error form-control" id="Country" aria-invalid="true"><option value="0">$</option></select>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="checkbox"><input type="checkbox" class="checkbox" id="automotive3"><label for="automotive3"><span></span> Discount</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><button type="submit" class="btn btn-pink-border btn-block margin-right-35">Cancel</button></div>
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <button type="submit" class="btn btn-pink btn-block">Save</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>


        <section>
            <div class="row">
                <div class="col-xs-12">
                    <div class="white-wrapper mar-top-20">
                        <!-- /.box-header -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th colspan="3">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><span class="blue-border">1</span></td>
                                        <td>Doctor</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td width="60"><div class="profile-edit"><a href="#"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></div></td>
                                        <td width="50"><div class="edit-icon"><a href=""><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></div></td>
                                        <td width="50"><div class="trash"><a href="#"><img src="../images/del@2x.png" width="14" height="18" alt="trash"></a></div></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="blue-border">2</span></td>
                                        <td>Doctor</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td width="60"><div class="profile-edit"><a href="#"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></div></td>
                                        <td width="50"><div class="edit-icon"><a href=""><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></div></td>
                                        <td width="50"><div class="trash"><a href="#"><img src="../images/del@2x.png" width="14" height="18" alt="trash"></a></div></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="blue-border">3</span></td>
                                        <td>Doctor</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td width="60"><div class="profile-edit"><a href="#"><img src="../images/eye.png" width="29" height="18" alt="profile"></a></div></td>
                                        <td width="50"><div class="edit-icon"><a href=""><img src="../images/edit@2x.png" width="18" height="18" alt="edit"></a></div></td>
                                        <td width="50"><div class="trash"><a href="#"><img src="../images/del@2x.png" width="14" height="18" alt="trash"></a></div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
    </div>
    <!-- /.content -->
</div>