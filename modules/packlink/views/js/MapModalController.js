/**
 * 2020 Packlink
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Apache License 2.0
 * that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * @author    Packlink <support@packlink.com>
 * @copyright 2020 Packlink Shipping S.L
 * @license   http://www.apache.org/licenses/LICENSE-2.0.txt  Apache License 2.0
 */

var Packlink = window.Packlink || {};

(function () {
  function MapModalControllerConstructor(configuration) {
    this.display = display;
    this.close = close;

    let modal = null;
    let closeButton = null;
    let ajaxService = Packlink.ajaxService;

    let locations = [];

    let selectedId;
    let lang;

    function display() {
      modal = document.getElementById('pl-map-modal');
      modal.classList.remove('hidden');

      document.getElementById('pl-modal-spinner').classList.remove('disabled');

      closeButton = document.getElementById('pl-close-modal-btn');
      closeButton.addEventListener('click', closeClickedListener);

      lang = configuration.lang ? configuration.lang : 'en';

      let locationsModel = {
        method: 'getLocations',
        methodId: configuration.methodId
      };

      if (configuration.addressId) {
        locationsModel.addressId = configuration.addressId;
      }

      ajaxService.post(configuration.getUrl, locationsModel, getLocationsSuccessHandler)
    }

    /**
     * Closes modal.
     */
    function close() {
      modal.classList.add('hidden');
      closeButton.removeEventListener('click', closeClickedListener);
    }

    /**
     * Handles communication with location picker library.
     *
     * @param id
     */
    function onDropoffSelected(id) {
      selectedId = id;
      selectDropoff();
    }

    /**
     * Location retrieve success handler.
     *
     * @param response
     */
    function getLocationsSuccessHandler(response) {
      locations = response;

      if (!locations || locations.length === 0) {
        configuration.onComplete({type: 'no-locations'});
      }

      submitLocations();
    }

    /**
     * Submits location to location library.
     */
    function submitLocations() {
      Packlink.locationPicker.display(locations, onDropoffSelected, configuration.dropOffId, lang);
      document.getElementById('pl-modal-spinner').classList.add('disabled');
    }

    /**
     * Handles close button clicked event.
     */
    function closeClickedListener() {
      configuration.onComplete({type: 'close'});
    }

    /**
     * Selects dropoff location.
     */
    function selectDropoff() {
      document.getElementById('pl-modal-spinner').classList.remove('disabled');
      let dropOffModel = {
        method: 'postSelectedDropoff',
        carrierId: configuration.carrierId,
        dropOff: getSelectedDropoff()
      };

      if (configuration.cartId) {
        dropOffModel.cartId = configuration.cartId;
        dropOffModel.orderId = configuration.orderId;
      }

      ajaxService.post(configuration.getUrl, dropOffModel, selectDropoffSuccessHandler);
    }

    /**
     * Select dropoff location success callback.
     */
    function selectDropoffSuccessHandler() {
      document.getElementById('pl-modal-spinner').classList.add('disabled');
      configuration.onComplete(
          {
            type: 'success',
            address: getAddressString(getSelectedDropoff()),
            dropOff: getSelectedDropoff()
          }
      )
    }

    /**
     * Retrieves selected dropoff.
     *
     * @return {object}
     */
    function getSelectedDropoff() {
      let dropOff = {};

      for (let loc of locations) {
        if (loc.id === selectedId) {
          dropOff = loc;
          break;
        }
      }

      return dropOff;
    }

    /**
     * Returns formatted address.
     *
     * @param {object} location
     * @return {string}
     */
    function getAddressString(location) {
      return location['name'] + ', ' + location['address'] + ', ' + location['zip'] + ', ' + location['city'];
    }
  }

  Packlink.MapModalController = MapModalControllerConstructor;
})();
