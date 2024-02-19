<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Logic Test</title>
  </head>
  <body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-container">
                    Add Container
                </button>
                @if (Session::has('message'))
                    <div class="alert {{ Session::get('alert-class', 'alert-primary') }} mt-2" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Container Number</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($containers->count() > 0)
                                @foreach ($containers as $item)
                                    @php
                                    $position = "";
                                        switch ($item->position) {
                                            case 1:
                                                $position = "Center";
                                                break;
                                            case 2:
                                                $position = "Right";
                                                break;
                                            case 3:
                                                $position = "Left";
                                                break;
                                            case 4:
                                                $position = "Dead";
                                                break;
                                            default:
                                                $position = "Not Valid";
                                                break;
                                        }
                                    @endphp
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $position }}</td>
                                        </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Data not available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Modal Add -->
                <div class="modal fade" id="modal-add-container" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Add Container</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('page.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Container Number</label>
                                        <input type="number" name="number" class="form-control" placeholder="Container number must have 7 numeric" maxlength="7" required onkeypress="if(this.value.length==7) return false;">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Position</label>
                                        <select name="position" class="form-select" required>
                                            <option value="">Select Position</option>
                                            @php
                                                $position = [[1, "Center"], [2, "Right"], [3, "Left"], [4, "Dead"]]
                                            @endphp
                                            @for ($i = 0; $i < count($position); $i++)
                                                <option value="{{ $position[$i][0] }}">{{ $position[$i][1] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>