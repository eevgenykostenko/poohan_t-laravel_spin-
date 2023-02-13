@extends('layouts.app')
@section('page_style')
    @parent

    <style rel="stylesheet">
        body {
            background-image: url("{{ asset('bg.jpg')  }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <canvas id='canvas' width='500' height='500'>
                    Canvas not supported, use another browser.
                </canvas>

                <div class="mb-3">
                    <label for="voucher_code" class="form-label text-white">Kode Voucher</label>
                    <input type="text" name="voucher_code" id="voucher_code" class="form-control"/>
                </div>
                <button class="btn btn-primary" id="runSpinBtn">Submit</button>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    @parent

    <script type="text/javascript" src="{{ asset('js/win-wheel.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('js/TweenMax.min.js')  }}"></script>
    <script>
        const rewards = {{ Js::from($rewards) }};
        var theWheel, spinIndex

        $(function () {
            if (rewards.length === 0)
                return;

            const segments = rewards.map((reward) => {
                return {'text': reward.name, 'fillStyle': reward.bg_color, 'textFillStyle': reward.text_color,}
            })

            theWheel = new Winwheel({
                'numSegments': rewards.length,
                'outerRadius': 200,
                'innerRadius': 70,
                'segments': segments,
                'animation':
                    {
                        'type': 'spinToStop',
                        'duration': 5,
                        'spins': 8,
                        'callbackFinished': 'alertPrize()'
                    }
            });

            $('#runSpinBtn').click(function () {
                const voucherCode = $('#voucher_code').val()
                if (!voucherCode) return

                $.ajax({
                    url: `{{ route('voucher.run-spin') }}`,
                    data: {
                        voucher_code: voucherCode,
                    },
                    success: function (res) {
                        if (res === "invalid_voucher_code") {
                            swal('Voucher code invalid')
                        } else {
                            spinIndex = res
                            // Important thing is to set the stopAngle of the animation before stating the spin.
                            // theWheel.animation.stopAngle = theWheel.segments[spinIndex].startAngle;
                            theWheel.animation.stopAngle = theWheel.getRandomForSegment(spinIndex)
                            // Start the spin animation here.
                            theWheel.startAnimation();
                        }
                    }
                })
            })

        })

        function alertPrize() {
            swal(`You won ${rewards[spinIndex - 1].name}`).then((value) => {
                location.reload()
            });
        }

    </script>
@endsection