<?php
/**----------------------------------------------------------------------------------
* Microsoft Developer & Platform Evangelism
*
* Copyright (c) Microsoft Corporation. All rights reserved.
*
* THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND, 
* EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES 
* OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
*----------------------------------------------------------------------------------
* The example companies, organizations, products, domain names,
* e-mail addresses, logos, people, places, and events depicted
* herein are fictitious.  No association with any real company,
* organization, product, domain name, email address, logo, person,
* places, or events is intended or should be inferred.
*----------------------------------------------------------------------------------
**/

/** -------------------------------------------------------------
# Azure Storage Blob Sample - Demonstrate how to use the Blob Storage service. 
# Blob storage stores unstructured data such as text, binary data, documents or media files. 
# Blobs can be accessed from anywhere in the world via HTTP or HTTPS. 
#
# Documentation References: 
#  - Associated Article - https://docs.microsoft.com/en-us/azure/storage/blobs/storage-quickstart-blobs-php 
#  - What is a Storage Account - http://azure.microsoft.com/en-us/documentation/articles/storage-whatis-account/ 
#  - Getting Started with Blobs - https://azure.microsoft.com/en-us/documentation/articles/storage-php-how-to-use-blobs/
#  - Blob Service Concepts - http://msdn.microsoft.com/en-us/library/dd179376.aspx 
#  - Blob Service REST API - http://msdn.microsoft.com/en-us/library/dd135733.aspx 
#  - Blob Service PHP API - https://github.com/Azure/azure-storage-php
#  - Storage Emulator - http://azure.microsoft.com/en-us/documentation/articles/storage-use-emulator/ 
#
**/

require_once 'vendor/autoload.php';
require_once "./random_string.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;

// $connectionString = 

// Create blob client.
$blobClient = BlobRestProxy::createBlobService("DefaultEndpointsProtocol=https;AccountName=storagesyalva;AccountKey=Amb8ryiuLIBIQSZps9UvVBuogXPCK2EvmjJ9u70sYwPKiAmLePvT5/xqT7yPI3oZUZM/zjMYdvqU7KhbhU82ig==;EndpointSuffix=core.windows.net");

// $fileToUpload = "HelloWorld.txt";


if (isset($_GET["Upload"])) {

    // $target_dir = "uploads/";
    // $fileToUpload = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $imageFileType = strtolower(pathinfo($fileToUpload,PATHINFO_EXTENSION));
    // move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileToUpload);

    // $fileToUpload = "/uploads/1-intro-photo-final.jpg";

    // Create container options object.
    $createContainerOptions = new CreateContainerOptions();

    // Set public access policy. Possible values are
    // PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
    // CONTAINER_AND_BLOBS:
    // Specifies full public read access for container and blob data.
    // proxys can enumerate blobs within the container via anonymous
    // request, but cannot enumerate containers within the storage account.
    //
    // BLOBS_ONLY:
    // Specifies public read access for blobs. Blob data within this
    // container can be read via anonymous request, but container data is not
    // available. proxys cannot enumerate blobs within the container via
    // anonymous request.
    // If this value is not specified in the request, container data is
    // private to the account owner.
    $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

    // Set container metadata.
    $createContainerOptions->addMetaData("key1", "value1");
    $createContainerOptions->addMetaData("key2", "value2");

      $containerName = "blockblobs".generateRandomString();

    try {
        // Create container.
        $blobClient->createContainer($containerName, $createContainerOptions);

        $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
        $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");

        //Upload blob
        $blobClient->createBlockBlob($containerName, $fileToUpload, $content);

        $listBlobsOptions = new ListBlobsOptions();
        $listBlobsOptions->setPrefix("");
        $result = $blobClient->listBlobs($containerName, $listBlobsOptions);

    }
    catch(ServiceException $e){
        // Handle exception based on error codes and messages.
        // Error codes and messages are here:
        // http://msdn.microsoft.com/library/azure/dd179439.aspx
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }
    catch(InvalidArgumentTypeException $e){
        // Handle exception based on error codes and messages.
        // Error codes and messages are here:
        // http://msdn.microsoft.com/library/azure/dd179439.aspx
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }
} 
elseif(isset($_GET["Cleanup"])) 
{

    try{
        // Delete container.
        echo "Deleting Container".PHP_EOL;
        echo $_GET["containerName"].PHP_EOL;
        echo "<br />";
        $blobClient->deleteContainer($_GET["containerName"]);
    }
    catch(ServiceException $e){
        // Handle exception based on error codes and messages.
        // Error codes and messages are here:
        // http://msdn.microsoft.com/library/azure/dd179439.aspx
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message."<br />";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submission Mohamad Syalva Syalabi Rosyidy</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<body>
 
<script type="text/javascript">
    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************
 
        // Replace <Subscription Key> with your valid subscription key.
        var subscriptionKey = "c987df628ae247278fc8a88aae515397";
 
        // You must use the same Azure region in your REST API method as you used to
        // get your subscription keys. For example, if you got your subscription keys
        // from the West US region, replace "westcentralus" in the URL
        // below with "westus".
        //
        // Free trial subscription keys are generated in the "westus" region.
        // If you use a free trial subscription key, you shouldn't need to change
        // this region.
        var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
 
        // Request parameters.
        var params = {
            "visualFeatures": "Categories,Description,Color",
            "details": "",
            "language": "en",
        };
 
        // Display the image.
        var sourceImageUrl = document.getElementById("inputImage").value;
        document.querySelector("#sourceImage").src = sourceImageUrl;
 
        // Make the REST API call.
        $.ajax({
            url: uriBase + "?" + $.param(params),
 
            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader(
                    "Ocp-Apim-Subscription-Key", subscriptionKey);
            },
 
            type: "POST",
 
            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })
 
        .done(function(data) {
            // Show formatted JSON on webpage.
            $("#responseTextArea").val(JSON.stringify(data, null, 2));
            $("#description").text(data.description.captions[0].text)
        })
 
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Display error message.
            var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
            errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
            alert(errorString);
        });
    };
</script>

 
<h1>Analyze image:</h1>

<?php 
    if (!isset($_GET["Upload"])) {
        echo 'Upload an image, then click the <strong>Upload image</strong> button.<br><br>
        <form action="index.php?Upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload"  accept=".jpeg,.jpg,.png" required="" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>';
    }
?>

<?php 
    if (isset($_GET["Upload"])) {
        
        # code...
        foreach ($result->getBlobs() as $blob) {
        
            echo 'Click the <strong>Analyze image</strong> button.
            <br><br>
            Image to analyze:
            <input type="text" name="inputImage" id="inputImage"
                value="'.$blob->getUrl().'" />
            <button onclick="processImage()">Analyze image</button>
            <br><br>
            <div id="imageDiv" style="width:420px; display:table-cell;">
            <h4>Source image:</h4>
                    <img id="sourceImage" width="400" />
            <h4>Description</h4>
            <h4 id="description"></h4>
            </div>';
        }        
    }
?>

</body>
</html>


<!-- <form method="post" action="phpQS.php?Cleanup&containerName=<?php echo $containerName; ?>">
    <button type="submit">Press to clean up all resources created by this sample</button>
</form> -->
