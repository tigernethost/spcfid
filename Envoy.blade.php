@servers(['localhost' => 'user@200.10.10.115'])
 
@task('list', ['on' => 'localhost'])
    ls -la
@endtask