@extends('layouts.master2')

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

            <a href="{{ route ('produit.create')}}" class="btn  bg-gradient-primary">Ajouter produit</a><br><br>


            @if (Session::get('success_message'))
                <div class="alert alert-success">{{ Session::get('success_message') }}</div>
            @endif

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Liste des produits</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Référence</th>
                  <th>Produitt</th>

                  <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                    @forelse ($produits as $produit)

                <tr>
                  <td>{{ $produit->ref }}</td>
                  <td>{{ $produit->libelle }}</td>

                  <td>
                    <a class="btn-sm btn-warning" href="{{ route('produit.edit', $produit->id) }}">Modifier</a>

                    <a class="btn-sm btn-danger" href="{{ route('produit.delete', $produit->id) }}">Supprimer</a>
                  </td>
                </tr>
                @empty

                <tr>
                    <td class="cell" colspan="3">Aucun produit ajoutés</td>

                </tr>
                @endforelse


                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

  @endsection
