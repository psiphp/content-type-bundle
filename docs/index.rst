Content Type Bundle
===================

The content type bundle integrates the Psi Content Type component with
Symfony.

See the `Psi Content Type`_ component documentation for general reference.

Extending
---------

The bundle allows you to easily register new fields, views and mappings with
tagged services.

Fields
~~~~~~

**Tag**: `psi_content_type.field`

Add a new "markdown" field:

.. code-block:: xml

    <service id="acme.field.markdown" class="Acme\ContentType\Field\MarkdownField">
        <tag name="psi_content_type.field" alias="markdown" />
    </service>

Views
~~~~~

**Tag**: `psi_content_type.view`

Add a new image view: 

.. code-block:: xml

    <service id="acme.view.image" class="Acme\ContentType\View\ImageView">
        <tag name="psi_content_type.view" />
    </service>

Mapping
~~~~~~~

**Tag**: `psi_content_type.mapping`

Add a new storage mapping type: 

.. code-block:: xml

    <service id="acme.mapping.blob" class="Acme\ContentType\Mapping\BlobMapping">
        <tag name="psi_content_type.mapping" alias="blob" />
    </service>

.. _Psi Content Type: https://psiphp.readthedocs.io/en/latest/components/content-type/docs/index.html

Storage Drivers
~~~~~~~~~~~~~~~

Storage mechanisms can be added through the bundles extension class before the
container is compiled. See the ``PsiContentTypeBundle`` class for more information.
