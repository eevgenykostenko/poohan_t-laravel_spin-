@extends('layouts.admin')

@section('admin_content')
    <div class="card">
        <div class="d-flex card-header">
            <h5>Prize List</h5>
            <button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                    data-bs-target="#manageRewardsModal">Manage
            </button>
        </div>
        <div class="card-body">
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="manageRewardsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Manage Rewards</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rewards') }}" method="post" id="rewardsForm">
                        @csrf
                        <table id="manageRewardsTable" class="table">
                            <thead>
                            <tr>
                                <th></th>
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
                    <button class="btn btn-sm btn-primary" id="addRewardBtn">Add</button>
                    <button class="btn btn-sm btn-primary me-auto" id="balanceRewardsBtn">Balancing</button>
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-primary" id="saveRewardsBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    @parent

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
            integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script>
        var rewards = {{ Js::from($rewards) }}
        console.log(rewards)

        const $rewardsTbody = $('#manageRewardsTable tbody')
        $(function () {
            var rewardsHtml = rewards.reduce((html, reward) => {
                return html + `
                    <tr>
                        <td><i class="fas fa-arrows-alt"></i></td>
                        <td><input type="text" name="name[]" value="${reward.name}" required/></td>
                        <td><input type="number" name="percent[]" value="${reward.percent}" required/></td>
                        <td><input type="color" name="bg_color[]" value="${reward.bg_color}" required/></td>
                        <td><input type="color" name="text_color[]" value="${reward.text_color}" required/></td>
                        <td><button type="button" class="delete-reward btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></td>
                    </tr>
                `
            }, "")
            $rewardsTbody.html(rewardsHtml)
            $rewardsTbody.sortable()
        })


        $('#addRewardBtn').click(function () {
            $rewardsTbody.append(`
                <tr>
                    <td><i class="fas fa-arrows-alt"></i></td>
                    <td><input type="text" name="name[]" value="" required/></td>
                    <td><input type="number" name="percent[]" value="0" required/></td>
                    <td><input type="color" name="bg_color[]" value="#FFFFFF" required/></td>
                    <td><input type="color" name="text_color[]" value="#000000" required/></td>
                    <td><button type="button" class="delete-reward btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></td>
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
                swal('total percent should be 100%')
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

        $(document).on('click', '.delete-reward', function () {
            $(this).closest('tr').remove()
        })

    </script>
@endsection

