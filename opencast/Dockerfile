FROM quay.io/opencast/allinone:11.3

COPY ./org.ops4j.pax.logging.cfg /opencast/etc/org.ops4j.pax.logging.cfg

# Setup LTI for moodle
COPY ./mh_default_org.xml /opencast/etc/security/mh_default_org.xml
COPY ./org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg /opencast/etc/org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg
COPY ./org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg /opencast/etc/org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg

# Overwrite entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]