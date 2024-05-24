<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Indian - Elections</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,500,600,700' rel='stylesheet' type='text/css' />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" />
    <link href="Content/material-cards.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <style>
        body {
            background-image: url('https://cdn.downtoearth.org.in/library/large/2019-03-11/0.09953400_1552311607_gettyimages-995745414.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }
        img {
            vertical-align: middle;
        }
        
        .img-responsive,
        .thumbnail > img,
        .thumbnail a > img,
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
        display: block;
        max-width: 100%;
        height: auto;
        }
        .img-rounded {
            border-radius: 6px;
        }
        .img-thumbnail {
            display: inline-block;
            max-width: 100%;
            height: auto;
            padding: 4px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }
        .img-circle {
            border-radius: 50%;
        }
        .welcome-container {
            text-align: center;
            margin-top: 20%;
            color: orange; /* Highlighted/glittery color */
        }
        .welcome {
            font-family: 'Raleway', sans-serif;
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center; /* Centering the text */
        }
        .description {
            color: green;
            text-align: center;
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!--Nav bar-->
    <form runat="server">
    <nav class="orange" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="Default.aspx" class="brand-logo">Indian Elections</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="voter_login.html">LOGIN</a></li>
                <li><a href="registration_page.php">REGISTER</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="admin.php">ADMIN</a></li>
                <li style="text-transform:uppercase;">
                    <asp:LoginName ID="LoginName1" runat="server" />
                </li>
                <li style="text-transform:uppercase;">
                    <asp:LoginStatus ID="LoginStatus1" runat="server"/>
                </li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="voter_login.html">LOGIN</a></li>
                <li><a href="registration_page.php">REGISTER</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="admin.php">ADMIN</a></li>
                <li>
                     <a href="#" style="text-transform:uppercase;"><asp:LoginName ID="LoginName2" runat="server" /></a>
                </li>
                <li style="text-transform:uppercase;">
                    <asp:LoginStatus ID="LoginStatus2" runat="server"/>
                </li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!--Nav bar End-->
    <div class="welcome-container">
        <div class="welcome">
            <p>                 Welcome to Indian Election 2024!    </p>
        </div>
        <div class="description">
            <p>                 Experience the democracy at its best. Participate in the electoral process, exercise your right to vote, and make a difference in shaping the future of our nation.</p>
            <p>                 Explore the candidates, understand the issues, and cast your vote responsibly. Together, let's build a stronger, more prosperous India.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <asp:GridView ID="GridView1" runat="server" AllowPaging="True" AutoGenerateColumns="False" DataKeyNames="id" DataSourceID="SqlDataSource1" CellPadding="4" ForeColor="#333333" GridLines="None">
                <AlternatingRowStyle BackColor="White" />
                <Columns>
                    <asp:BoundField DataField="id" HeaderText="ID" InsertVisible="False" ReadOnly="True" SortExpression="id" />
                    <asp:BoundField DataField="title" HeaderText="Title" SortExpression="title" />
                    <asp:BoundField DataField="starttime" HeaderText="Start" SortExpression="starttime" />
                    <asp:BoundField DataField="endtime" HeaderText="End" SortExpression="endtime" />
                    <asp:BoundField DataField="descriptionelection" HeaderText="Description" SortExpression="descriptionelection" />
                        </ItemTemplate>
                    </asp:TemplateField>
                </Columns>
                <EditRowStyle BackColor="#7C6F57" />
                <FooterStyle BackColor="#1C5E55" Font-Bold="True" ForeColor="White" />
                <HeaderStyle BackColor="#1C5E55" Font-Bold="True" ForeColor="White" />
                <PagerStyle BackColor="#666666" ForeColor="White" HorizontalAlign="Center" />
                <RowStyle BackColor="#E3EAEB" />
                <SelectedRowStyle BackColor="#C5BBAF" Font-Bold="True" ForeColor="#333333" />
                <SortedAscendingCellStyle BackColor="#F8FAFA" />
                <SortedAscendingHeaderStyle BackColor="#246B61" />
                <SortedDescendingCellStyle BackColor="#D4DFE1" />
                <SortedDescendingHeaderStyle BackColor="#15524A" />
            </asp:GridView>
            <asp:SqlDataSource ID="SqlDataSource1" runat="server" ConnectionString="Data Source=RAJAT\SQLEXPRESS;Initial Catalog=Voting;User ID=sa;Password=bl00dsql" ProviderName="System.Data.SqlClient" SelectCommand="SELECT * FROM [elections]"></asp:SqlDataSource>
        </div>
    </div>
    </form>

    <script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script src="Scripts/init.js" type="text/javascript"></script>
</body>
</html>
