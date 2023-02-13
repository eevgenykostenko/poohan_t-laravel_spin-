@extends('layouts.admin')

@section('admin_content')
    <div class="d-flex">
        <h2 class="mb-3">Prize List</h2>
        <button class="btn btn-primary btn-sm mb-3 ms-3" data-bs-toggle="modal" data-bs-target="#manageRewardsModal">Manage</button>
    </div>
    <table id="example" class="dataTable table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rewards as $reward)
            <tr>
                <td>{{ $loop->index + 1  }}</td>
                <td>{{ $reward->name  }}</td>
                <td>{{ $reward->percent. "%"  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="manageRewardsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Manage Rewards</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rewards') }}" method="post" id="rewardsForm">
                        @csrf
                        <table id="manageRewardsTable" class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Percentage</th>
                                <th>Bg color</th>
                                <th>Text color</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="addRewardBtn">Add</button>
                    <button class="btn btn-primary me-auto" id="balanceRewardsBtn">Balancing</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="saveRewardsBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    @parent
    <script>
        var rewards = {{ Js::from($rewards) }}
        console.log(rewards)
        $(function () {
            drawRewardsTable()
        })

        function drawRewardsTable() {
            var rewardsHtml = rewards.reduce((html, reward) => {
                return html + `
                    <tr>
                        <td><input type="text" name="name[]" value="${reward.name}" required/></td>
                        <td><input type="number" name="percent[]" value="${reward.percent}" required/></td>
                        <td><input type="color" name="bg_color[]" value="${reward.bg_color}" required/></td>
                        <td><input type="color" name="text_color[]" value="${reward.text_color}" required/></td>
                        <td><button type="button" class="btn btn-danger delete-reward btn-sm"><i class="fas fa-trash-alt"></i></td>
                    </tr>
                `
            }, "")
            $('#manageRewardsTable tbody').html(rewardsHtml)
        }

        $('#addRewardBtn').click(function () {
            $('#manageRewardsTable tbody').append(`
                <tr>
                    <td><input type="text" name="name[]" value="" required/></td>
                    <td><input type="number" name="percent[]" value="0" required/></td>
                    <td><input type="color" name="bg_color[]" value="#FFFFFF" required/></td>
                    <td><input type="color" name="text_color[]" value="#000000" required/></td>
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></td>
                </tr>
            `)
        })

        var getTotalPercents = () => {
            var totalPercents = 0
            $(`#manageRewardsTable tbody input[name="percent[]"]`).each(function () {
                totalPercents += $(this).val() * 1;
            })
            return totalPercents
        }

        $('#balanceRewardsBtn').click(function () {
            $lastRewardPriceInput = $(`#manageRewardsTable tbody tr:last-child input[name="percent[]"]`)
            var totalPercents = getTotalPercents();
            var percents = totalPercents - $lastRewardPriceInput.val() * 1
            if (percents > 100) {
                alert('total percent should be 100%')
                return
            }

            $lastRewardPriceInput.val(100 - percents)
        })

        $('#saveRewardsBtn').click(function () {
            var totalPercents = getTotalPercents()
            if (totalPercents !== 100) {
                alert('total percent should be 100%')
                return;
            }

            $('#rewardsForm').submit()
        })

        $(document).on('click', '.delete-reward', function(){
            $(this).closest('tr').remove()
        })

    </script>
@endsection

