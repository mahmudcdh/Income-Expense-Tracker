@extends('layouts.ieapp')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Income Page</h1>

            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Income List</h5>
                        </div>
                        <div class="card-body">
                            <table id="incomeTable" class="table table-bordered table-hover table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total Income</td>
                                    <td colspan="2">Amount</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Income</h5>
                        </div>
                        <div class="card-body">
                            <form id="addIncomeForm" action="">
                                <div class="form-group mb-2">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" id="description" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>
                                <button type="button" onclick="incomeCreate()" class="btn btn-secondary btn-sm"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        incomeList()
        async function incomeList(){
            let res = await axios.get('/apiIncomeList')
            let incomeTable = $('#incomeTable')
            let tbody = $('#tbody')
            incomeTable.DataTable().destroy();
            tbody.empty()
            res.data.forEach((item, index)=>{
                let row = (`<tr>
                                <td>${index +1}</td>
                                <td>${item['date']}</td>
                                <td>${item['description']}</td>
                                <td>${item['amount']}</td>
                                <td>
                                    <a onclick="btnEdit(${item['id']})" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a id="btnDelete" class="btn btn-danger btn-sm" onclick="btnDelete(${item['id']})"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>`)
                tbody.append(row)
            })
            incomeTable.DataTable({
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

        async function incomeCreate(){
            let date = $('#date').val()
            let description = $('#description').val()
            let amount = $('#amount').val()

            if(date.length === 0){
                errorToast('Date is required')
            }else if(description.length === 0){
                errorToast('Description is required')
            }else if(amount.length === 0){
                errorToast('Amount is required')
            }else{
                let res = await axios.post('/apiIncomeCreate',{
                    date:date, description:description, amount:amount
                })

                if(res.status === 200 && res.data['status']==='success'){
                    successToast(res.data['message'])
                    setTimeout(function (){
                        $('#addIncomeForm').trigger('reset')
                        incomeList()
                    }, 2000)
                }else{
                    errorToast(res.data['message'])
                }

            }
        }
    </script>
@endsection
