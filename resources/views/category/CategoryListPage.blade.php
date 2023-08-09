@extends('layouts.ieapp')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Category Page</h1>

            <div class="row mb-4">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Category List</h5>
                        </div>
                        <div class="card-body">
                            <table id="categoryTable" class="table table-bordered table-hover table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Category</h5>
                        </div>
                        <div class="card-body">
                            <form id="addCategoryForm" action="">
                                <div class="form-group mb-3">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <button type="button" onclick="categoryCreate()" class="btn btn-secondary btn-sm"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        categoryList()
        async function categoryList(){
            let res = await axios.get('/apiCategoryList')
            let categoryTable = $('#categoryTable')
            let tbody = $('#tbody')
            categoryTable.DataTable().destroy();
            tbody.empty()
            res.data.forEach((item, index)=>{
                let row = (`<tr>
                                <td>${index +1}</td>
                                <td>${item['name']}</td>
                                <td>
                                    <a onclick="btnEdit(${item['id']})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a id="btnDelete" class="btn btn-danger btn-sm" onclick="btnDelete(${item['id']})"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>`)
                tbody.append(row)
            })
            categoryTable.DataTable({
                order: [[0, 'asc']],
                lengthMenu: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                language: {
                    paginate: {
                        next: '&#8594;', // or '→'
                        previous: '&#8592;' // or '←'
                    }
                }
            })
        }

        async function categoryCreate(){
            let name = $('#name').val()

            if(name.length === 0){
                errorToast('Category Name is required')
            }else{
                let res = await axios.post('/apiCategoryCreate',{
                    name:name,
                })

                if(res.status === 200 && res.data['status']==='success'){
                    successToast(res.data['message'])
                    setTimeout(function (){
                        $('#addCategoryForm').reset()
                        categoryList()
                    }, 2000)
                }else{
                    errorToast('Something went wrong..!')
                }

            }
        }
    </script>
@endsection
