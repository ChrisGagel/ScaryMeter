<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="ScaryMeter._Default" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <asp:Image ID="imageBackgroundScene" CssClass="imageBackgroundScene" runat="server" />

    <div class="row">
        <div class="col-md-3">
            <div style="background-color:red; width:100%; text-align: center;">
                <asp:Image ID="imageMoviePoster" CssClass="imageMoviePoster" runat="server" />
            </div>
        </div>
        <div class="col-md-9">
            <div style="background-color:green; width:100%;">
                <asp:Label ID="labelMovieYear" CssClass="labelMovieYear" Text="2016" runat="server"></asp:Label>
                <br />
                <asp:Label ID="labelMovieTitle" CssClass="labelMovieTitle" Text="Swiss Army Man" runat="server"></asp:Label>
                <br />
                <asp:Label ID="labelScaryMeterRatingTitle" CssClass="labelScaryMeterRatingTitle" Text="Scary Meter Rating" runat="server"></asp:Label>
            </div>
        </div>

    </div>


</asp:Content>
