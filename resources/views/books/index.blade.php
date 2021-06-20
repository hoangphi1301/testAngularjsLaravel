<div ng-controller="bookController">

<div id="showBook" class="table-content" style="padding: 0px 10%;display: none;">
	<div class="row">
		<label class="bg-success col-12 p-3 text-white text-center"><h3>Danh sách Sách</h3></label>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" ng-click="eventModal('add')">Thêm Sách</button>
	</div>
	<div class="form-group">
		<table class="table">
		  <thead>
		    <tr>
		      <th class="col col-md-1">#</th>
		      <th class="col col-md-2">Tên</th>
		      <th class="col col-md-3">Nội dung</th>
		      <th class="col col-md-1">Giá</th>
		      <th class="col col-md-2">Nhà xuất bản</th>
		      <th class="col col-md-1">Bút danh</th>
		      <th class="col col-md-2">Action</th>
		    </tr>
		  </thead>
		  <tbody>
			    <tr ng-repeat="book in books">
			      <th><%book.id%></th>
			      <td><%book.name%></td>
			      <td><%book.content%></td>
			      <td><%book.price | number:0%></td>
			      <td><%book.publisher%></td>
			      <td><%book.penname%></td>
			      <td>
			      	<a href="" ng-click="eventModal('edit',book.id)" class="btn btn-success">Sửa</a>
			      	<a href="" ng-click="eventModal('delete',book.id)" class="btn btn-danger">Xóa</a>
			      </td>
			    </tr>
		  </tbody>

		</table>
		<div class="myPagination">
			<ul>
			  <li class="prev"><a href="#" ng-click="pagination(currentPage-1,'book')">previous</a></li>
			  <li class="centerPaginationBook" ng-repeat="page in maxPage"><a href="#" ng-click="pagination(page,'book')"><%page%></a></li>
			  <li class="next"><a ng-click="pagination(currentPage+1,'book')" href="#">next</a></li>
			</ul>
		</div>

	</div>	

</div>

<!-- {{-- Modal Book --}} -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel"><%titleModal%></h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <form>
		  <div class="modal-body">
		    	<div class="form-group">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Nhập tên Sách</label>
				    <input  type="text" ng-model="book.name" class="form-control" placeholder="Nhập tên sách">
				    <i class="text-danger"><%erName%></i>
				  </div>
				    <div class="form-group">
				    <label for="exampleInputEmail1">Nhập nội dung</label>
				    <textarea rows="4" ng-model="book.content" class="form-control" placeholder="Nhập nội dung"> </textarea>
				    <i class="text-danger"><%erContent%></i>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Nhập giá bán</label>
				    <input type="number" ng-model="book.price" class="form-control" placeholder="Nhập giá bán">
				    <i class="text-danger"><%erPrice%></i>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Nhà xuất bản</label>
				    <input type="text" ng-model="book.publisher" class="form-control" placeholder="Nhà xuất bản">
				    <i class="text-danger"><%erPublisher%></i>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Bút danh</label>
				    <input type="text" ng-model="book.penname" class="form-control" placeholder="Bút danh">
				    <i class="text-danger"><%erPenname%></i>
				  </div>
				
			</div>
		  </div>
		  <div class="modal-footer">
		   		<button type="button" ng-click="saveBook(status,id)" class="btn btn-primary">Xác Nhận</button>
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
		  </div>
		  </form>
		</div>
	</div>
</div>

</div>
