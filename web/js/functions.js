$('#tipo_exportacao').on('change', () => {
    const selectedType = $('#tipo_exportacao').val();
    $.ajax({
      url: '/sites/export-data?type=' + selectedType,
      method: 'GET',
      dataType: 'json', // Define o tipo de dados esperados como JSON
      success: function(response) {
        // Limpa a tabela
        $('#sitesTable tbody').empty();
  
        // Converte o objeto JSON em um array de chaves e valores
        const sitesArray = Object.entries(response);
  
        // Adiciona os novos dados à tabela
        sitesArray.forEach(function([key, site]) {
          $('#sitesTable tbody').append(`
            <tr>
              <td><input type="checkbox" name="export[]" value="${key}" /></td>
              <td>${site}</td>
            </tr>
          `);
        });
      },
      error: function(xhr, status, error) {
        // Trata erros, se necessário
        console.error(error);
      }
    });
  });
  

  $('#tipo_exportacao').on('change', function() {
    const selectedValue = $(this).val();
    const tipoIntegralizacaoSelect = $('select[name="tipo_integralizacao"]');
  
    if (selectedValue === '2') { // Se tipo_exportacao for igual a 2 (Medições de energia)
      // Adiciona a opção "15 minutos" no início do select
      tipoIntegralizacaoSelect.prepend('<option value="0" selected>15 minutos</option>');
    } else {
      // Remove a opção "15 minutos", caso exista
      tipoIntegralizacaoSelect.find('option[value="0"]').remove();
    }
  });
  