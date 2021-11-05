/**
 *
 * @param clientId  The clientId to query for
 * @returns K4sClient
 */
function client(clientId)
{
  if(typeof K4sClient._instances[clientId] === "undefined") {
    K4sClient._instances[clientId] = new K4sClient();
  }
  return K4sClient._instances[clientId];
}


class K4sClient {

  static _instances = {};

  constructor() {


  }

  init() {

  }


  /**
   * @inheritDoc fetch()
   */
  fetch()
  {

  }


}


client().init({
  openid_host: "http://localhost",
  client_id: "client1",
  scopes: ["openid"],
  observe_query_param: "kid"
});


client().fetch()


