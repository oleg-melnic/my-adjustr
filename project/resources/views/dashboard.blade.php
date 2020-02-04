@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title float-left">Claims</h4>
                <p class="card-category float-right">
                    <button type="button" onclick="window.location='{{ route("claims.create") }}'" class="btn btn-success">New Claim</button>
                </p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Insurance Provider</th>
                  <th>Type of property</th>
                  <th>Type of damages sustained</th>
                  <th>Created Date</th>
                  <th>State</th>
                  <th class="text-right">Actions</th>
                </thead>
                <tbody>
                    @foreach($data as $item)
                      <tr>
                        <td>{{ $item->getIdentity() }}</td>
                        <td>{{ $item->getProvider() }}</td>
                        <td>{{ $item->getProperty() }}</td>
                        <td>{{ $item->getDamages() }}</td>
                        <td>{{ $item->getCreateDate()->format('m/d/Y') }}</td>
                        <td>{{ $item->getState()->getName() }}</td>
                        <td class="td-actions text-right">
                            <button type="button" onclick="window.location='{{ route('claims-edit', ['itemId' => $item->getIdentity()]) }}'" rel="tooltip" title="Edit Claim" class="btn btn-primary btn-link btn-sm">
                              <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                              <i class="material-icons">close</i>
                            </button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
