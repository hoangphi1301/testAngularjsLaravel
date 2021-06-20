
<div id="showUser" class="table-content" style="padding: 0px 20%;display: none;">
	
	<div class="row">
		<label class="bg-success col-12 p-3 text-white text-center"><h3>Danh sách User</h3></label>
	</div>
	<div class="row justify-content-between">
		<div class="form-group col col-4">
			<button class="btn btn-primary" ng-click="eventModal('add')">Thêm User</button>
		</div>
		 <div class="form-inline col col-4">
		      <input ng-model="search" ng-change="searchUser()" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" />
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
	    </div>
	</div>

	<div class="form-group">
		
		<table class="table" id="Tabla">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Tên</th>
		      <th scope="col">Email</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			    <tr ng-repeat="user in users">
			      <th scope="row"><%user.id%></th>
			      <td><%user.name%></td>
			      <td><%user.email%></td>
			      <td>
			      	<a href="" ng-click="eventModal('edit',user.id)" class="btn btn-success">Sửa</a>
			      	<a href="" ng-click="eventModal('delete',user.id)" class="btn btn-danger">Xóa</a>
			      </td>
			    </tr>
		  </tbody>

		</table>

		<div class="myPagination">
			<ul>
			  <li class="prev"><a href="#" ng-click="pagination(currentPage-1,'user')">previous</a></li>
			  <li class="centerPaginationUser" ng-repeat="page in maxPage"><a href="#" ng-click="pagination(page,'user')"><%page%></a></li>
			  <li class="next"><a ng-click="pagination(currentPage+1,'user')" href="#">next</a></li>
			</ul>
		</div>
		
	</div>	

</div>

{{-- Modal User --}}
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel"><%titleModal%></h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <form id="form-create">
		  <div class="modal-body">
		    	<div class="form-group">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Nhập tên User</label>
				    <input  type="text" ng-model="user.name" class="form-control" placeholder="Nhập tên user">
				    <i class="text-danger"><%erName%></i>
				  </div>
				    <div class="form-group">
				    <label for="exampleInputEmail1">Nhập Email</label>
				    <input type="email" ng-model="user.email" class="form-control" placeholder="Nhập email">
				    <i class="text-danger"><%erEmail%></i>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Nhập mật khẩu</label>
				    <input type="password" ng-model="user.password" class="form-control" placeholder="Nhập password">
				    <i class="text-danger"><%erPassword%></i>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
				    <input type="password" ng-model="user.repassword" class="form-control" placeholder="Xác nhận password">
				    <i class="text-danger"><%erRepassword%></i>
				  </div>
				
			</div>
		  </div>
		  <div class="modal-footer">
		   		<button type="button" ng-click="saveUser(status,id)" class="btn btn-primary">Xác Nhận</button>
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
		  </div>
		  </form>
		</div>
	</div>
</div>
