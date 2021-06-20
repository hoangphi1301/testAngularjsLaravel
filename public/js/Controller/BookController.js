 app.controller('bookController',function($scope,$http){
        $scope.eventModal = function(status,id){
            $scope.status = status;
            $scope.id = id;

            if(status == 'add'){
                $scope.book = null;
                $scope.erName = '';
                $scope.erContent = '';
                $scope.erPrice = '';
                $scope.erPublisher = '';
                $scope.erPenname = '';
                $scope.titleModal = "Thêm Sách";
                $('#bookModal').modal('show');
            }

            if(status == 'edit'){
                $scope.erName = '';
                $scope.erContent = '';
                $scope.erPrice = '';
                $scope.erPublisher = '';
                $scope.erPenname = '';
                $scope.titleModal = "Sửa Sách";
                $('#bookModal').modal('show');

                $http.get('book/edit/'+id).then(function(response){
                    $scope.book = response.data;
                },function(response){
                    console.log(response);
                });
            }

            if(status == 'delete'){
                var confirmDelete = confirm('Bạn có muốn xóa không ?');
                if(confirmDelete){
                    $http.get('book/delete/'+id).then(function(response){
                        $scope.books.forEach(function(value,index){
                            if(value.id==id){
                                $scope.books.splice(index,1);
                            }
                        });
                        books.forEach(function(value,index){
                            if(value.id==id){
                                books.splice(index,1);
                            }
                        });
                    },function(response){
                        console.log(response);
                    });
                }
            }
        }

        $scope.saveBook = function(status,id){
            if(status == 'add'){
                data = $scope.book;
                $http({
                    method: 'post',
                    url: 'book/store',
                    data: $.param(data),
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function(response){
                    var errors = response.data.errors;
                    if(errors){
                        $scope.erName = !errors.name ? '': errors.name[0];
                        $scope.erContent = !errors.content ? '':errors.content[0];
                        $scope.erPrice = !errors.price ? '':errors.price[0];
                        $scope.erPublisher = !errors.publisher ? '':errors.publisher[0];
                        $scope.erPenname = !errors.penname ? '':errors.penname[0];
                    }
                    if(response.data.success){
                        data.id = response.data.id;
                        $scope.books.push(data);
                        books.push(data);
                        $('#bookModal').modal('hide');
                    }
                },function(response){
                    console.log(response);
                });
            }

            if(status == 'edit'){
                var data = $scope.book;
                $http({
                    method:'post',
                    url:'book/update/'+id,
                    data: $.param(data),
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function(response){
                    var errors = response.data.errors;
                    if(errors){
                        $scope.erName = !errors.name ? '': errors.name[0];
                        $scope.erContent = !errors.content ? '':errors.content[0];
                        $scope.erPrice = !errors.price ? '':errors.price[0];
                        $scope.erPublisher = !errors.publisher ? '':errors.publisher[0];
                        $scope.erPenname = !errors.penname ? '':errors.penname[0];
                    }
                    if(response.data.success){
                        $scope.books.forEach(function(value,index){
                            if(value.id==id){
                                $scope.books[index] = data;
                            }
                        });
                         books.forEach(function(value,index){
                            if(value.id==id){
                                books[index] = data;
                            }
                        });
                        $('#bookModal').modal('hide');
                    }
                },function(response){
                    console.log(response);
                });
            }
        }
    });
