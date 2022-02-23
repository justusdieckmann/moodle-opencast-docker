FROM quay.io/opencast/allinone:11.3

# Setup LTI for moodle
COPY ./mh_default_org.xml /opencast/etc/security/mh_default_org.xml
COPY ./org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg /opencast/etc/org.opencastproject.kernel.security.OAuthConsumerDetailsService.cfg
COPY ./org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg /opencast/etc/org.opencastproject.security.lti.LtiLaunchAuthenticationHandler.cfg

# Overwrite entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]