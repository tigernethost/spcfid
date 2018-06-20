
@servers(['web-3' => 'pi@200.10.10.113'])

@task('deploy', ['on' => ['web-3']])
   ping -c4 200.10.10.113
@endtask