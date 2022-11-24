 <div>
     <a href="{{ route($attributes->get('name') . '.edit', $attributes->get('id')) }}" class="btn btn-xs btn-primary"><i
             class="glyphicon glyphicon-edit"></i>
         Edit</a>
     <a href="{{ route(route($attributes->get('name') . '.destroy', $attributes->get('id'))) }}"
         class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>
         Delete</a>
 </div>
