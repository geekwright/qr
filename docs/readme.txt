Qr Module Version 1.2 for XOOPS and ImpressCMS

Overview
========
This module adds QR Code(R) generating capabilities to a XOOPS
or ImpressCMS site. Codes can be added to your site through 
blocks or by direct script calls.

Installation
============
The distribution archive can be expanded directly into the main
directory of your XOOPS or ImpressCMS site. Then, install the qr 
module from the system administration area of your CMS.

Usage
=====
It is recommended to set the 'order' of the qr module to 0 to
hide it from view. The main and only page is blank unless you
add blocks to it.

Group access permissions to the qr module are required to
display QR codes, above and beyond the block display permission. 
QR generation starts from a scripts in the qr module directory
which use the standard mainfile inclusion. This adds a layer of
additional protections (such as protector) but requires access
permissions to work as intended.

Four blocks are available.

Manual QR Code          - Display any string as a QR code
MECARD                  - Docomo MECARD format QR code
This Page QR Code       - Displays URL for the page in QR code.
                          The URL includes only the specified 
                          variables in a 'get' type request.
This Page QR Code Extra - Same as 'This Page QR Code' but uses 
                          the blocks/qr_blockx.html template, 
                          for use in installations needing 
                          multiple customizations.

Additionally, a qr code image in png format can be generated 
outside of the supplied blocks by supplying these scripts as
the SRC URL in an HTML IMG tag:

Generate code for any arbitrary data:
modules/qr/getqrcode.php?qrdata=DATA_TO_ENCODE

Generate MECARD code (name, email, url) for a XOOPS user:
modules/qr/uidmecard.php?uid=nnn
If no uid is specified, the current user is used.

Generate MECARD code from individual structured data:
modules/qr/getmecard.php?N=name&TEL=+15555551212&email=name@example.com
The following named request variables are interpred as MECARD
fields. These request variable names are accepted as either all
upper or all lower case (not mixed):

  N        (name)
  SOUND    (kana
  TEL      (phone number)
  TEL-AV   (video phone number)
  EMAIL    (email address)
  NOTE     (notes)
  BDAY     (birthday)
  ADR      (address)
  URL      (web site URL)
  NICKNAME (nickname)

The N (name) is generally required by code scanners, and thus is 
required to generate a code. All other variables are optional, and 
will be used only if specified.

Notes
=====
During installation, the actual qr generating code is copied
to the trustpath. This library is kept on the trustpath to prevent 
direct access to the scripts it contains. This controls access 
according to CMS permissions, minimizes security considerations it
might otherwise expose, and isolates the code by license.

The code remaining in the htdocs folder is covered under GPL V2, 
while in the trustpath, Y.Swetake's excellent QRcode Perl CGI & 
PHP script ver.0.50i is covered under a separate free software 
license documented in both the docs and trustpath folders.

More information on the QRcode library scripts see:
http://www.swetake.com/qr/index-e.html

This module has been tested in ImpressCMS versions 1.2.7 and 1.3.4,
and in Xoops version 2.5.5.

This module was developed by Geekwright, LLC. Report any bugs
or issues to richard@geekwright.com

QR Code is a registered trademark of Denso Wave Incorporated
