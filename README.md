# SHCC Image API Challenge

System to apply a filter of blur, brightness, and contrast on images sent attached by post request.

The only mandatory parameter is the image. In case the other parameters were not set, the system discards those filters.


Used Framework: Lumen

How to use:
After the installation, and with the server running, open the Postman, and configure the header with the information below:
- Method: POST
- Body (Key, Value):
- image, (attached image)
- contrast, (-100 to 100)
- blur, (0 to 100)
- brightness, (-100 to 100)