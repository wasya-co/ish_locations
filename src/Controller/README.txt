
// dpm($nodeIds);

      // $ids = reset($ids);


      $featureIds = $nodeStorage->getQuery()
        ->condition('status', 1)
        ->condition('field_is_feature', 1)
        ->condition('type', 'article')
        ->condition('nid', $featureNodeIds, 'IN')
        ->sort('created', 'DESC')
        ->pager(15)
        ->accessCheck(TRUE)
        ->execute();

    // $entity = \Drupal::entityTypeManager()->getStorage($entity_type)->load(1);
    // $entities = \Drupal::entityTypeManager()->getStorage($entity_type)->loadMultiple([1, 2, 3]);
    // $entities = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'article']);


    // $newsitemIds = $nodeStorage->getQuery()
    //   ->condition('status', 1)
    //   // ->condition('field_is_feature', [1], 'NOT IN')
    //   ->condition('type', 'article')
    //   // ->condition('nid', $nodeIds, 'IN')
    //   ->sort('created', 'DESC')
    //   ->pager(15)
    //   ->accessCheck(TRUE)
    //   ->execute();



    /* get the feature nodes */
    $query = \Drupal::database()->select('taxonomy_index', 'ti');
    $query->fields('ti', array('nid'));
    /* and */
    // $query->condition('ti.tid', [ $tagId ], 'IN');
    $and = $query->andConditionGroup();
    $and->condition('ti.tid', $tagId);
    $query->condition($and);
    /* and */
    // $query->condition('ti.tid', [ $tagFeatureId ], 'IN');
    $and = $query->andConditionGroup();
    $and->condition('ti.tid', $tagFeatureId);
    $query->condition($and);
    /* cont */
    $query->distinct(TRUE);
    $query->range(0, 9);
    $result = $query->execute();
    $featureNodeIds = $result->fetchCol();
    dpm($featureNodeIds, 'featureNodeIds');
    if ($featureNodeIds) {
      $features = $nodeStorage->loadMultiple($featureNodeIds);
      $build['#features'] = $features;
    }

