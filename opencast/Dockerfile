FROM quay.io/opencast/allinone:13.12

# Setup LTI for moodle
COPY ./mh_default_org.xml /opencast/etc/security/mh_default_org.xml
COPY ./org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg /opencast/etc/org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg
COPY ./org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg /opencast/etc/org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg

# Enable serving static files without authentication
COPY org.opencastproject.fsresources.StaticResourceServlet.cfg /opencast/etc/org.opencastproject.fsresources.StaticResourceServlet.cfg

# Copy workflows for duplication import.
COPY lms-automated-duplicate.xml /opencast/etc/workflows/lms-automated-duplicate.xml
COPY lms-publish-duplicate.xml /opencast/etc/workflows/lms-publish-duplicate.xml

# Overwrite entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
