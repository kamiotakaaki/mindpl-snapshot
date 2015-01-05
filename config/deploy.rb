# config valid only for current version of Capistrano
lock '3.3.5'

set :application, 'snapshot'
set :repo_url, 'git@bitbucket.org:mindpl/snapshot.git'

ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

set :deploy_to, '/var/www/webapps/snapshot/'
set :scm, :git
set :format, :pretty
set :log_level, :debug
set :pty, true
#set :deploy_via, :copy

set :ssh_options, {
  keys: [File.expand_path('~/.ssh/mindpl.pem')],
  forward_agent: true,
  auth_methods: %w(publickey)
}


namespace :deploy do

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end
