Feature: View Makers list
    As a guest user
    I want to view the list of car makers
    So that I can see the available makers

    Scenario: Guest user clicks on "Gyártók" and views Makers list
        Given I am on the homepage
        When I follow "Gyártók"
        Then I should be on "/makers"
        And I should see the heading "Gyártók"
        And I should see a list of makers
