set :stage, :production

role :web, %w{ec2-user@ec2-54-179-215-142.ap-southeast-1.compute.amazonaws.com}

server 'ec2-54-179-215-142.ap-southeast-1.compute.amazonaws.com', user: 'ec2-user', roles: %w{web}

fetch(:default_env).merge!(rails_env: :production)



