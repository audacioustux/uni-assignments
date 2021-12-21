<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<%@ page isELIgnored="false" %>

<html>
<head>
    <title>Product Form</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1>User Form</h1>

<form:form action="./" modelAttribute="product">
    <form:errors path="productId" cssClass="error"/>
    Product Id: <form:input path="productId"/>
    <br><br>
    <form:errors path="productName" cssClass="error"/>
    Product Name: <form:input path="productName"/>
    <br><br>
    <form:errors path="quantity" cssClass="error"/>
    Quantity: <form:input path="quantity"/>
    <br><br>
    <form:errors path="productCategory" cssClass="error"/>
    Product Category: <form:input path="productCategory"/>

    <br><br>
    <input type="submit" value="Submit" />
</form:form>

</body>
</html>
