<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 9/2/2017
 * Time: 3:57 PM
 */
?>
<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="panel">
            <div class="p-20">
                <div class="row">
                    <div class="col-xs-6">
                        <h5 class="m-b-0">This months task</h5>
                        <h3 class="m-t-0 font-medium">TO-DO LIST</h3>
                    </div>
                    <div class="col-xs-6">
                        <a href="javascript:void(0)" class="pull-right btn btn-rounded btn-danger m-t-15"
                           data-toggle="modal" data-target="#myModal">Add Task</a>
                    </div>
                </div>
            </div>
            <!-- .modal for add task -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Add Task</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter Your Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2"
                                           placeholder="Enter email">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="panel-footer">
                <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">
                            <label for="inputSchedule"> <span>Schedule meeting with</span> </label>
                        </div>
                        <ul class="assignedto">
                            <li><img src="../plugins/images/users/1.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Steave"/></li>
                            <li><img src="../plugins/images/users/2.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Jessica"/></li>
                            <li><img src="../plugins/images/users/3.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Priyanka"/></li>
                            <li><img src="../plugins/images/users/4.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Selina"/></li>
                        </ul>
                    </li>
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                            <label for="inputCall"> <span>Give Purchase report to</span> <span
                                        class="label label-danger label-rounded">Today</span> </label>
                        </div>
                        <ul class="assignedto">
                            <li><img src="../plugins/images/users/3.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Priyanka"/></li>
                            <li><img src="../plugins/images/users/4.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Selina"/></li>
                        </ul>
                    </li>
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputBook" name="inputCheckboxesBook">
                            <label for="inputBook"> <span>Book flight for holiday</span> </label>
                        </div>
                        <div class="item-date"> 26 jun 2017</div>
                    </li>
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputForward" name="inputCheckboxesForward">
                            <label for="inputForward"> <span>Forward all tasks</span> <span
                                        class="label label-warning label-rounded">2 weeks</span> </label>
                        </div>
                        <div class="item-date"> 26 jun 2017</div>
                    </li>
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                            <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                        </div>
                        <div class="item-date"> 26 jun 2017</div>
                    </li>
                    <li class="list-group-item" data-role="task">
                        <div class="checkbox checkbox-info">
                            <input type="checkbox" id="inputForward2" name="inputCheckboxesd">
                            <label for="inputForward2"> <span>Important tasks</span> <span
                                        class="label label-success label-rounded">2 weeks</span> </label>
                        </div>
                        <ul class="assignedto">
                            <li><img src="../plugins/images/users/1.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Assign to Steave"/></li>
                            <li><img src="../plugins/images/users/2.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Assign to Jessica"/></li>
                            <li><img src="../plugins/images/users/4.jpg" alt="user img" data-toggle="tooltip"
                                     data-placement="top" title="Assign to Selina"/></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 col-sm-12 m-b-30">
        <div id="calendar"></div>
    </div>
    <!-- BEGIN MODAL -->
    <div class="modal fade none-border" id="my-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add Event</strong></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                        event
                    </button>
                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                            data-dismiss="modal">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-new-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add</strong> a category</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Category Name</label>
                                <input class="form-control form-white" placeholder="Enter name" type="text"
                                       name="category-name"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..."
                                        name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    <option value="inverse">Inverse</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                            data-dismiss="modal">Save
                    </button>
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>
