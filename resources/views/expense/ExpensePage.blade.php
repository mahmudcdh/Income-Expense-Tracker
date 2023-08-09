@extends('layouts.ieapp')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Expense Page</h1>

            <div class="row mb-4">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Expense List</h5>
                        </div>
                        <div class="card-body">
                            <table id="expenseTable" class="table table-bordered table-hover table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Expense</td>
                                    <td colspan="2">Amount</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Expense</h5>
                        </div>
                        <div class="card-body">
                            <form id="addExpenseForm" action="">
                                <div class="form-group mb-2">
                                    <input type="date" name="date" id="date" class="form-control form-control-sm">
                                </div>
                                <div class="form-group mb-2">
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        <option selected>- Select Category -</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" name="description" id="description" class="form-control form-control-sm" placeholder="Description">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="number" name="amount" id="amount" class="form-control form-control-sm" placeholder="Amount">
                                </div>
                                <button type="button" onclick="expenseCreate()" class="btn btn-secondary btn-sm"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        getCategory()
        async function getCategory(){
            let res = await axios.get('/apiGetCategory')
            let category = $('#category_id')

            res.data.forEach((item)=>{
                let option = (`
                                <option value="${item['id']}">${item['name']}</option>
                              `)
                category.append(option)
            })
        }

        expenseList()
        async function expenseList(){
            let res = await axios.get('/apiExpenseList')
            let expenseTable = $('#expenseTable')
            let tbody = $('#tbody')
            expenseTable.DataTable().destroy();
            tbody.empty()
            res.data.forEach((item)=>{
                let row = (`<tr>
                                <td>${item['date']}</td>
                                <td>${item['category_id']}</td>
                                <td>${item['description']}</td>
                                <td>${item['amount']}</td>
                                <td>
                                    <a onclick="btnEdit(${item['id']})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a id="btnDelete" class="btn btn-danger btn-sm" onclick="btnDelete(${item['id']})"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>`)
                tbody.append(row)
            })
            expenseTable.DataTable({
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

        async function expenseCreate(){
            let date = $('#date').val()
            let category_id = $('#category_id').val()
            let description = $('#description').val()
            let amount = $('#amount').val()

            if(date.length === 0){
                errorToast('Date is required')
            }else if(category_id.length === 0){
                errorToast('Select a Category')
            }else if(description.length === 0){
                errorToast('Description is required')
            }else if(amount.length === 0){
                errorToast('Amount is required')
            }else{
                let res = await axios.post('/apiExpenseAdd',{
                    date:date, category_id:category_id, description:description, amount:amount
                })

                if(res.status === 200 && res.data['status']==='success'){
                    successToast(res.data['message'])
                    setTimeout(function (){
                        $('#addExpenseForm').trigger('reset')
                        expenseList()
                    }, 2000)
                }else{
                    errorToast(res.data['message'])
                }

            }
        }

    </script>
@endsection
