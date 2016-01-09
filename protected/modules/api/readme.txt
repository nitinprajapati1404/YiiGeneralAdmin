#####CODE By : Sanket Virani & Nitin Prajapati
## use this method while we are providing database access to application and they will manage all logic
#### Setup
1.Copy this "api" directory to /protected/modules
2.add this line in config/main.php
    'modules' => array(
        'api'
    )

#### To access APIs
##### To add new record in any table using model ( With model rules )
    localhost/xyz/index.php/api/default/post?model=<your_module>&key=D3das==
    data = {"name":"api1","phone":"234343","message":"sample message 4"};


##### To update record in any table using model ( With model rules )
    localhost/xyz/index.php/api/default/put?model=<your_module>&key=D3das==&id=1
    data = {"name":"api1","phone":"234343","message":"sample message 4"};


##### To delete record in any table using model ( With model rules )
    localhost/xyz/index.php/api/default/put?model=<your_module>&key=D3das==&id=1


##### To record record in any table using model ( With model rules )
    localhost/xyz/index.php/api/default/get?model=<your_module>&key=D3das==&id=1


#### Pass all data into
    Body->x-www-form-urlencoded(Postman)

Thank you